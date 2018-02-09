<div class="sidebar" data-color="purple" data-image="{{asset('img/sidebar-1.jpg')}}">
    <div class="logo">
        <a href="#" class="hp-logo">
            <img src="{{asset('img/logo-white.png')}}" >
        </a>
    </div>
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            HP
        </a>
        <a href="#" class="hp-logo">
            <img src="{{asset('img/logo-white.png')}}" >
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="active">
                <a href="{{URL::route('dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#reco_side_menu">
                    <i class="material-icons">settings</i>
                    <p>Recognizance
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="reco_side_menu">
                    <ul class="nav">
                        <li>
                            <a href="{{URL::route('all-announcements')}}">
                                <span class="sidebar-normal">Announcements & Events</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::route('all-awards')}}">
                                <span class="sidebar-normal">Awards</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#company_side_menu">
                    <i class="material-icons">settings</i>
                    <p>Company
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="company_side_menu">
                    <ul class="nav">
                        <li>
                            <a href="{{URL::route('all-company-transactions')}}">
                                <span class="sidebar-normal">Transactions</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::route('all-employees-transfers')}}">
                                <span class="sidebar-normal">Employee Transfer</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="sidebar-normal">Request Happyperks</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#employee_side_menu">
                    <i class="material-icons">settings</i>
                    <p>Employees
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="employee_side_menu">
                    <ul class="nav">
                        <li>
                            <a href="{{URL::route('all-employees')}}">
                                <span class="sidebar-normal">All Employees</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#configs_side_menu">
                    <i class="material-icons">settings</i>
                    <p>Configurations
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="configs_side_menu">
                    <ul class="nav">
                        <li>
                            <a href="{{URL::route('edit-profile')}}">
                                <span class="sidebar-normal">Company Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::route('all-company-departments')}}">
                                <span class="sidebar-normal">Departments</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::route('all-company-locations')}}">
                                <span class="sidebar-normal">Locations</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::route('all-company-designations')}}">
                                <span class="sidebar-normal">Designations</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#reports_side_menu">
                    <i class="material-icons">settings</i>
                    <p>Reports
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="reports_side_menu">
                    <ul class="nav">
                        <li>
                            <a href="">
                                <span class="sidebar-normal">Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::route('all-company-activities')}}">
                                <span class="sidebar-normal">Activity Log</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </li>
        </ul>
    </div>
</div>