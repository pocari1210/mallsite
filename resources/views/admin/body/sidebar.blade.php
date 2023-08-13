<div class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">Admin</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">

    <li>
      <a href="{{ route('admin.dashboard') }}">
        <div class="parent-icon"><i class='bx bx-cookie'></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-home-circle'></i>
        </div>
        <div class="menu-title">Brand</div>
      </a>
      <ul>
        <li> <a href="{{ route('all.brand') }}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
        </li>
        <li> <a href="{{ route('add.brand') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand </a>
        </li>
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Category</div>
      </a>
      <ul>
        <li> <a href="{{ route('all.category') }}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
        </li>
        <li> <a href="{{ route('add.category') }}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">SubCategory</div>
      </a>
      <ul>
        <li> <a href="{{ route('all.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>All SubCategory</a>
        </li>
        <li> <a href="{{ route('add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Add SubCategory</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Application</div>
      </a>
      <ul>
        <li> <a href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>Email</a>
        </li>
        <li> <a href="app-chat-box.html"><i class="bx bx-right-arrow-alt"></i>Chat Box</a>
        </li>
        <li> <a href="app-file-manager.html"><i class="bx bx-right-arrow-alt"></i>File Manager</a>
        </li>
        <li> <a href="app-contact-list.html"><i class="bx bx-right-arrow-alt"></i>Contatcs</a>
        </li>
        <li> <a href="app-to-do.html"><i class="bx bx-right-arrow-alt"></i>Todo List</a>
        </li>
        <li> <a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i>Invoice</a>
        </li>
        <li> <a href="app-fullcalender.html"><i class="bx bx-right-arrow-alt"></i>Calendar</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Product Manage</div>
      </a>
      <ul>
        <li> <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
        </li>
        <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Slider Manage</div>
      </a>
      <ul>
        <li> <a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
        </li>
        <li> <a href="{{ route('add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Banner Manage</div>
      </a>
      <ul>
        <li> <a href="{{ route('all.banner') }}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
        </li>
        <li> <a href="{{ route('add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Coupon System</div>
      </a>
      <ul>
        <li> <a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
        </li>
        <li> <a href="{{ route('add.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Shipping Area </div>
      </a>
      <ul>
        <li> <a href="{{ route('all.division') }}"><i class="bx bx-right-arrow-alt"></i>All Division</a>
        </li>
        <li> <a href="{{ route('all.district') }}"><i class="bx bx-right-arrow-alt"></i>All District</a>
        </li>
        <li> <a href="{{ route('all.state') }}"><i class="bx bx-right-arrow-alt"></i>All State</a>
        </li>
      </ul>
    </li>

    <li class="menu-label">UI Elements</li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-cart'></i>
        </div>
        <div class="menu-title">Vendor Manage </div>
      </a>
      <ul>
        <li> <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
        </li>
        <li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-cart'></i>
        </div>
        <div class="menu-title">Order Manage </div>
      </a>
      <ul>
        <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
        </li>
        <li> <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed Order</a>
        </li>
        <li> <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
        </li>
        <li> <a href="{{ route('admin.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered Order</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-cart'></i>
        </div>
        <div class="menu-title">Return Order </div>
      </a>
      <ul>
        <li> <a href="{{ route('return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return Request</a>
        </li>
        <li> <a href="{{ route('complete.return.request') }}"><i class="bx bx-right-arrow-alt"></i>Complete Request</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Reports Manage</div>
      </a>
      <ul>
        <li> <a href="{{ route('report.view') }}"><i class="bx bx-right-arrow-alt"></i>Report View</a>
        </li>
        <li> <a href="{{ route('order.by.user') }}"><i class="bx bx-right-arrow-alt"></i>Order By User</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">User Manage</div>
      </a>
      <ul>
        <li> <a href="{{ route('all-user') }}"><i class="bx bx-right-arrow-alt"></i>All User</a>
        </li>
        <li> <a href="{{ route('all-vendor') }}"><i class="bx bx-right-arrow-alt"></i>All Vendor</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Blog Manage</div>
      </a>
      <ul>
        <li> <a href="{{ route('admin.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Categroy</a>
        </li>
        <li> <a href="{{ route('all-vendor') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Post</a>
        </li>
      </ul>
    </li>

    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bx bx-repeat"></i>
        </div>
        <div class="menu-title">Content</div>
      </a>
      <ul>
        <li> <a href="content-grid-system.html"><i class="bx bx-right-arrow-alt"></i>Grid System</a>
        </li>
        <li> <a href="content-typography.html"><i class="bx bx-right-arrow-alt"></i>Typography</a>
        </li>
        <li> <a href="content-text-utilities.html"><i class="bx bx-right-arrow-alt"></i>Text Utilities</a>
        </li>
      </ul>
    </li>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
        </div>
        <div class="menu-title">Icons</div>
      </a>
      <ul>
        <li> <a href="icons-line-icons.html"><i class="bx bx-right-arrow-alt"></i>Line Icons</a>
        </li>
        <li> <a href="icons-boxicons.html"><i class="bx bx-right-arrow-alt"></i>Boxicons</a>
        </li>
        <li> <a href="icons-feather-icons.html"><i class="bx bx-right-arrow-alt"></i>Feather Icons</a>
        </li>
      </ul>
    </li>

    <li class="menu-label">Charts & Maps</li>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bx bx-line-chart"></i>
        </div>
        <div class="menu-title">Charts</div>
      </a>
      <ul>
        <li> <a href="charts-apex-chart.html"><i class="bx bx-right-arrow-alt"></i>Apex</a>
        </li>
        <li> <a href="charts-chartjs.html"><i class="bx bx-right-arrow-alt"></i>Chartjs</a>
        </li>
        <li> <a href="charts-highcharts.html"><i class="bx bx-right-arrow-alt"></i>Highcharts</a>
        </li>
      </ul>
    </li>

    <li>
      <a href=" " target="_blank">
        <div class="parent-icon"><i class="bx bx-support"></i>
        </div>
        <div class="menu-title">Support</div>
      </a>
    </li>
  </ul>
  <!--end navigation-->
</div>