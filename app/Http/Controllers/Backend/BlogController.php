<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use InterventionImage;
use Carbon\Carbon;

class BlogController extends Controller
{
  public function AllBlogCateogry()
  {

    $blogcategoryies = BlogCategory::latest()->get();

    return view(
      'backend.blog.category.blogcategroy_all',
      compact('blogcategoryies')
    );
  } // End Method 

  public function AddBlogCateogry()
  {
    return view('backend.blog.category.blogcategroy_add');
  } // End Method 

  public function StoreBlogCateogry(Request $request)
  {

    /****************************************************************
     * 
     * ★insertメソッド★
     * BlogCategoryモデルに、
     * \backend\blog\category\blogcategroy_add.blade.phpの
     * formから送信されてきた情報をレコードとして登録
     * 
     *★strtolowerメソッド★:
     * 大文字を小文字に変換
     * 
     *★str_replaceメソッド★
     * $request->blog_category_nameに
     * 半角スペース(第一引数)があった場合、
     * ハイフン(第二引数)に文字が変更される
     * 
     * Carbon::now()で現在の時刻を取得している
     * 
     ****************************************************************/

    BlogCategory::insert([
      'blog_category_name' => $request->blog_category_name,
      'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
      'created_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'Blog Category Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('admin.blog.category')->with($notification);
  } // End Method 

  public function EditBlogCateogry($id)
  {
    $blogcategoryies = BlogCategory::findOrFail($id);

    return view(
      'backend.blog.category.blogcategroy_edit',
      compact('blogcategoryies')
    );
  } // End Method 

  public function UpdateBlogCateogry(Request $request)
  {

    /****************************************************************
     * 
     * \backend\blog\category\blogcategroy_edit.blade.phpの
     * inputタグのhiddenのname情報からidを取得している
     * 
     ****************************************************************/

    $blog_id = $request->id;

    BlogCategory::findOrFail($blog_id)->update([
      'blog_category_name' => $request->blog_category_name,
      'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
    ]);

    $notification = array(
      'message' => 'Blog Category Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('admin.blog.category')->with($notification);
  } // End Method 

  public function DeleteBlogCateogry($id)
  {

    /*************************************************************
     * 
     * \blog\category\blogcategroy_all.blade.phpから
     * deleteボタンを押した$idの情報を
     * findOrFailメソッドで取得。
     * 
     * BlogCategoryモデルから$idで紐づいたレコードを
     * deleteメソッドで削除している
     * 
     ************************************************************/

    BlogCategory::findOrFail($id)->delete();

    $notification = array(
      'message' => 'Blog Category Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 

  //////////////////// Blog Post Methods //////////////////

  public function AllBlogPost()
  {

    $blogpost = BlogPost::latest()->get();
    return view('backend.blog.post.blogpost_all', compact('blogpost'));
  } // End Method 


  public function AddBlogPost()
  {
    $blogcategory = BlogCategory::latest()->get();
    return view('backend.blog.post.blogpost_add', compact('blogcategory'));
  } // End Method 

  public function StoreBlogPost(Request $request)
  {

    /****************************************************************
     * 
     * ★Imageの保存処理★
     * 
     * \backend\blog\post\blogpost_add.blade.phpの
     * formに入力されたname属性post_imageの画像データを
     * $imageで取得
     * 
     * 作成された画像名を$name_genに挿入
     * 
     * InterventionImage::makeでInterventionImageで画像のサイズを
     * 設定できるようにできる。
     * 、
     * resizeメソッドで横幅(第一引数),縦幅(第二引数)で
     * 画像のサイズを変更。
     * saveメソッドで、指定したディレクトリに画像を格納する
     * 
     * $save_urlに画像のの格納先のpathを挿入
     * 
     ***************************************************************/

    $image = $request->file('post_image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    InterventionImage::make($image)->resize(1103, 906)->save('storage/upload/blog/' . $name_gen);
    $save_url = 'storage/upload/blog/' . $name_gen;

    BlogPost::insert([
      'category_id' => $request->category_id,
      'post_title' => $request->post_title,
      'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
      'post_short_description' => $request->post_short_description,
      'post_long_description' => $request->post_long_description,
      'post_image' => $save_url,
      'created_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'Blog Post Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('admin.blog.post')->with($notification);
  } // End Method 

  public function EditBlogPost($id)
  {
    $blogcategory = BlogCategory::latest()->get();
    $blogpost = BlogPost::findOrFail($id);
    return view('backend.blog.post.blogpost_edit', compact('blogcategory', 'blogpost'));
  } // End Method 


  public function UpdateBlogPost(Request $request)
  {

    $post_id = $request->id;
    $old_img = $request->old_image;

    if ($request->file('post_image')) {

      $image = $request->file('post_image');
      $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
      InterventionImage::make($image)->resize(1103, 906)->save('storage/upload/blog/' . $name_gen);
      $save_url = 'storage/upload/blog/' . $name_gen;

      if (file_exists($old_img)) {
        unlink($old_img);
      }

      BlogPost::findOrFail($post_id)->update([
        'category_id' => $request->category_id,
        'post_title' => $request->post_title,
        'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
        'post_short_description' => $request->post_short_description,
        'post_long_description' => $request->post_long_description,
        'post_image' => $save_url,
        'updated_at' => Carbon::now(),
      ]);

      $notification = array(
        'message' => 'Blog Post Updated with image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('admin.blog.post')->with($notification);
    } else {

      BlogPost::findOrFail($post_id)->update([
        'category_id' => $request->category_id,
        'post_title' => $request->post_title,
        'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
        'post_short_description' => $request->post_short_description,
        'post_long_description' => $request->post_long_description,
        'updated_at' => Carbon::now(),
      ]);

      $notification = array(
        'message' => 'Blog Post Updated without image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('admin.blog.post')->with($notification);
    } // end else

  } // End Method 


  public function DeleteBlogPost($id)
  {

    $blogpost = BlogPost::findOrFail($id);
    $img = $blogpost->post_image;
    unlink($img);

    BlogPost::findOrFail($id)->delete();

    $notification = array(
      'message' => 'Blog Post Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method   

  //////////////////// Frontend Blog All Method //////////////

  public function AllBlog()
  {
    $blogcategoryies = BlogCategory::latest()->get();
    $blogpost = BlogPost::latest()->get();

    return view(
      'frontend.blog.home_blog',
      compact('blogcategoryies', 'blogpost')
    );
  } // End Method   

  public function BlogDetails($id, $slug)
  {
    $blogcategoryies = BlogCategory::latest()->get();
    $blogdetails = BlogPost::findOrFail($id);
    $breadcat = BlogCategory::where('id', $id)->get();

    return view(
      'frontend.blog.blog_details',
      compact('blogcategoryies', 'blogdetails', 'breadcat')
    );
  } // End Method   

  public function BlogPostCategory($id, $slug)
  {
    $blogcategoryies = BlogCategory::latest()->get();
    $blogpost = BlogPost::where('category_id', $id)->get();
    $breadcat = BlogCategory::where('id', $id)->get();

    return view(
      'frontend.blog.category_post',
      compact('blogcategoryies', 'blogpost', 'breadcat')
    );
  } // End Method 
}
