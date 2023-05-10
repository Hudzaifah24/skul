<div class="left_col scroll-view">

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="clearfix profile">
      <div class="profile_pic">
        <img src="{{ asset('assets/production/images/logo.png') }}" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>{{Auth::user()->role}}</span>
        <h2>
            @php
                $value = Auth::user()->name;
            @endphp
            {{ strtok($value, " ") }}
        </h2>
    </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li class="{{ (request()->is('/')) ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
              <i class="fa fa-home"></i> Dashboard
            </a>
          </li>
          <!-- ADMIN -->
          @if (Auth::user()->role == 'Admin')
            <li class="
                {{ (request()->is('student')) ? 'active' : '' }}
                {{ (request()->is('student/*')) ? 'active' : '' }}
            ">
                <a href="{{ route('student.index') }}">
                    <i class="fa fa-newspaper-o"></i> Siswa
                </a>
            </li>
            <li class="
                {{ (request()->is('teacher')) ? 'active' : '' }}
            ">
                <a href="{{ route('teacher.index') }}">
                    <i class="fa fa-users"></i> Guru
                </a>
            </li>
            <li class="
                {{ (request()->is('presence*')) ? 'active' : '' }}
            ">
                <a href="{{ route('presence.index') }}">
                    <i class="fa fa-clock-o"></i> Absen
                </a>
            </li>
            <li class="
                {{ (request()->is('studentClass/*')) ? 'active' : '' }}
                {{ (request()->is('attedance/*')) ? 'active' : '' }}
                {{ (request()->is('learning/*')) ? 'active' : '' }}
            ">
                <a><i class="fa fa-building"></i> Kelas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display:
                    {{ (request()->is('studentClass/*')) ? 'block' : '' }}
                    {{ (request()->is('attedance/*')) ? 'block' : '' }}
                    {{ (request()->is('learning/*')) ? 'block' : '' }}
                ">
                    <li>
                        <a href="{{ route('class.index') }}">List Kelas</a>
                    </li>
                    <li class="{{ (request()->is('studentClass/*')) ? 'active' : '' }}">
                        <a href="{{ route('studentClass.index') }}">Pilih Siswa</a>
                    </li>
                    <li class="{{ (request()->is('attendance')) ? 'active' : '' }}">
                        <a href="{{ route('attendance.index') }}">Kehadiran</a>
                    </li>
                    <li class="{{ (request()->is('learning/*')) ? 'active' : '' }}">
                        <a href="{{ route('learning.index') }}">Jadwal Pelajaran</a>
                    </li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-info"></i> Article <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                <li>
                    <a href="{{ route('article.index') }}">List Article</a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}">Kategori</a>
                </li>
                </ul>
            </li>
            <li class="
                {{ (request()->is('spppayment/*')) ? 'active' : '' }}
            ">
                <a><i class="fa fa-table"></i> SPP <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display:
                    {{ (request()->is('spppayment/*')) ? 'block' : '' }}
                ">
                    <li>
                        <a href="{{ route('spp.index') }}">List SPP</a>
                    </li>
                    <li class="{{ (request()->is('spppayment/*')) ? 'active' : '' }}">
                        <a href="{{ route('spppayment.index') }}">Pembayaran SPP</a>
                    </li>
                </ul>
            </li>
            <li class="
                {{ (request()->is('billPaymentGeneral/show')) ? 'active' : '' }}
                {{ (request()->is('billPaymentClass/show')) ? 'active' : '' }}
            ">
                <a><i class="fa fa-tags"></i> Tagihan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display:
                    {{ (request()->is('billPaymentGeneral/show')) ? 'block' : '' }}
                    {{ (request()->is('billPaymentClass/show')) ? 'block' : '' }}
                ">
                    <li>
                        <a href="{{route('bill.index')}}">List Tagihan</a>
                    </li>
                    <li class="
                        {{ (request()->is('billPaymentGeneral/show')) ? 'active' : '' }}
                        {{ (request()->is('billPaymentClass/show')) ? 'active' : '' }}
                    ">
                        <a>Pembayaran Tagihan<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display:
                            {{ (request()->is('billPaymentGeneral/show')) ? 'block' : '' }}
                            {{ (request()->is('billPaymentClass/show')) ? 'block' : '' }}
                        ">
                            <li>
                                <a href="{{ route('billPaymentGeneral.index') }}">Umum</a>
                            </li>
                            <li><a href="{{ route('billPaymentClass.index') }}">Kelas</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="
                {{ (request()->is('loan')) ? 'active' : '' }}
            ">
                <a href="{{ route('loan.index') }}">
                <i class="fa fa-tasks"></i> Perpustakaan
                </a>
            </li>
            <li class="
                {{ (request()->is('period')) ? 'active' : '' }}
            ">
                <a href="{{ route('period.index') }}">
                <i class="fa fa-clock-o"></i> Periode
                </a>
            </li>
            <li class="
                {{ (request()->is('admin')) ? 'active' : '' }}
            ">
                <a href="{{ route('admin.index') }}">
                <i class="fa fa-gear"></i> Pengguna
                </a>
            </li>

          <!-- TEACHER -->
          @else
            <li class="
                {{ (request()->is('student')) ? 'active' : '' }}
                {{ (request()->is('student/*')) ? 'active' : '' }}
            ">
                <a href="{{ route('student.index') }}">
                    <i class="fa fa-newspaper-o"></i> Hafalan
                </a>
            </li>
            <li class="
                {{ (request()->is('attendance')) ? 'active' : '' }}
            ">
                <a href="{{ route('attendance.index') }}">
                    <i class="fa fa-clock-o"></i> Kehadiran
                </a>
            </li>
            <li class="
                {{ (request()->is('presence*')) ? 'active' : '' }}
            ">
                <a href="{{ route('presence.index') }}">
                    <i class="fa fa-clock-o"></i> Absen
                </a>
            </li>
            <li class="
                {{ (request()->is('article')) ? 'active' : '' }}
            ">
                <a href="{{ route('article.index') }}">
                    <i class="fa fa-info"></i> Article
                </a>
            </li>
          @endif
        </ul>
      </div>
    </div>
</div>
