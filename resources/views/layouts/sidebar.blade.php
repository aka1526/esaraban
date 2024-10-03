  <nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="/assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">James Brown</div><small>Administrator</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a href="index.html"><i class="sidebar-item-icon fa fa-area-chart"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">เมนูเอกสาร</li>
            <li>
                <a href="{{ route('docrec.index') }}"><i class="sidebar-item-icon fa fa-arrow-right"></i>
                    <span class="nav-label">ทะเบียนรับเอกสาร</span>
                </a>
            </li>
            <li>
                <a href="{{ route('docsend.index') }}"><i class="sidebar-item-icon fa fa-arrow-left"></i>
                    <span class="nav-label">ทะเบียนส่งเอกสาร</span>
                </a>
            </li>
            <li>
                <a href="{{ route('doccenter.index') }}"><i class="sidebar-item-icon fa fa-random"></i>
                    <span class="nav-label">เอกสารภายใน</span>
                </a>
            </li>
            <li class="heading">Config System</li>



            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">ตั้งค่าระบบ</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li><a href="{{ route('sec-ex.index') }}">หน่วยงานภายนอก</a></li>
                    <li><a href="{{ route('sec-in.index') }}">หน่วยงานภายใน</a></li>
                    <li><a href="{{ route('project.index') }}">Project</a></li>
                    <li><a href="{{ route('doctype.index') }}">ประเภทเอกสาร</a></li>
                    <li><a href="{{ route('docgroup.index') }}">กลุ่มเอกสาร</a></li>
                    <li><a href="{{ route('docstatus.index') }}">สถานะเอกสาร</a></li>
                    <li><a href="{{ route('setting.index') }}">ตั้งค่าเอกสาร</a></li>
                    {{-- <li><a href="{{ route('mainmenu.index') }}">เพิ่มเมนูโปรแกรม</a></li> --}}


                </ul>
            </li>

        </ul>
    </div>
</nav>
