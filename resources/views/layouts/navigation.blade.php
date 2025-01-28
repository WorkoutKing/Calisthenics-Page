<div class="sidebar collapsed">
    <div class="sidebar-header">
        <h3>Menu</h3>
        <button class="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <ul class="sidebar-menu">
        @if(Auth::user())
            <li><a href="/"><i class="fas fa-house"></i> <span>Home</span></a></li>
            <li><a href="/elements"><i class="fas fa-stairs"></i> <span>Elements</span></a></li>
            <li><a href="/challenges"><i class="fas fa-person-running"></i> <span>challenges</span></a></li>
            <li><a href="/basics"><i class="fas fa-ranking-star"></i></i> <span>Basics</span></a></li>
            <li><a href="/posts"><i class="fas fa-newspaper"></i> <span>News & Updates</span></a></li>
            <br>
            @if (auth()->user()->role_id == 2)
                <li><a href="/admin/dashboard"><i class="fas fa-user-tie"></i><span>Admin Dashboard</span></a></li>
            @endif
            <li><a href="/profile"><i class="fas fa-user"></i><span>Profile</span></a></li>
            <li class="relative">
                <a href="/profile/notifications" class="relative">
                    <i class="fa-regular fa-bell">
                        @if (isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                            <div class="bg-red-500 text-white text-xs font-bold rounded-full px-2 py-0.5 the-bell-pos">
                                {{ $unreadNotificationsCount }}
                            </div>
                        @endif
                    </i>
                    <span>Notifications</span>
                </a>
            </li>
            <li><a href="/profile/settings"><i class="fas fa-gears"></i><span>Profile settings</span></a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="/logout" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-right-to-bracket"></i></i> <span>Log out</span></a>
                </form>
            </li>
        @else
            <li><a href="/"><i class="fas fa-house"></i> <span>Home</span></a></li>
            <li><a href="/elements"><i class="fas fa-stairs"></i> <span>Elements</span></a></li>
            <li><a href="/challenges"><i class="fas fa-person-running"></i> <span>challenges</span></a></li>
            <li><a href="/basics/statistics"><i class="fas fa-ranking-star"></i></i> <span>Basics</span></a></li>
            <li><a href="/posts"><i class="fas fa-newspaper"></i> <span>News & Updates</span></a></li>
            <!-- Add Register and Login buttons for mobile -->
            <li class="mobile-auth-links">
                <a href="/register"><i class="fas fa-user-plus"></i> <span>Register</span></a>
            </li>
            <li class="mobile-auth-links">
                <a href="/login"><i class="fas fa-sign-in-alt"></i> <span>Login</span></a>
            </li>
        @endif
    </ul>
</div>

<style>
    .sidebar.collapsed .the-bell-pos {
        left: 38px;
    }
    .sidebar .the-bell-pos {
        position: absolute;
        top: 3px;
        left: 30px;
    }
    main {
        margin: 40px 0px;
    }
    .sidebar .sidebar-menu li a span {
        margin-left: 15px;
    }
    .sidebar.collapsed .sidebar-header {
        display: flex;
        justify-content: center;
    }
    .sidebar.collapsed a {
        text-align: center;
    }
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        background-color: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(10px);
        color: #fff;
        transition: width 0s ease-in-out;
        //border: 1px solid;
        z-index: 2;
    }

    .sidebar.collapsed {
        width: 80px;
        background-color: #242424;
    }

    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
    }

    .sidebar-toggle {
        background-color: transparent;
        border: none;
        color: #fff;
        font-size: 24px;
        cursor: pointer;
    }

    .sidebar.collapsed .sidebar-menu li a span {
        display: none;
    }

    .sidebar.collapsed .sidebar-menu li a i {
        font-size: 20px;
    }

    .sidebar-menu {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li a {
        display: block;
        padding: 15px 20px;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease-in-out;
    }
    .sidebar-menu {
        margin-top: 50px;
    }
    .sidebar-menu li a:hover {
        background-color: #444;
    }

    .sidebar.collapsed .sidebar-header h3 {
        display: none;
    }

    .sidebar.collapsed .sidebar-menu li a span {
        display: none;
    }
        .mobile-auth-links {
            display: none; /* Hide by default */
        }

    /* Mobile-specific styles */
    @media screen and (max-width: 700px) {
        .second-nav .nav-links {
            display: none;
        }
        .sidebar.collapsed {
            width: 100%;
            background-color: transparent;
            border: unset;
            backdrop-filter: unset;
            height: auto;
        }
        .sidebar.collapsed .sidebar-menu {
            display: none;
        }
        .sidebar.collapsed .sidebar-header {
            position: absolute;
            border: 1px solid;
            background-color: #000;
            width: 65px;
            height: 64px;
            right: 0;
        }
        .sidebar {
            width: 100%;
        }
        .min-h-screen {
            width: 100%!important;
            margin-left: 0px!important;
        }
        .sidebar {
            position: absolute;
        }
        .mobile-auth-links {
            display: block; /* Show on mobile */
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sidebarToggle = document.querySelector('.sidebar-toggle');
        var sidebarClose = document.querySelector('.sidebar-close');
        var sidebar = document.querySelector('.sidebar');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });

        sidebarClose.addEventListener('click', function() {
            sidebar.classList.remove('collapsed');
        });
    });
</script>