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
            <li><a href="/elements"><i class="fas fa-stairs"></i> <span>Skills Progress</span></a></li>
            <li><a href="/challenges"><i class="fas fa-person-running"></i> <span>Challenges</span></a></li>
            <li><a href="/basics"><i class="fas fa-ranking-star"></i></i> <span>Basics</span></a></li>
            <li><a href="/posts"><i class="fas fa-newspaper"></i> <span>Articles</span></a></li>
            <li><a href="/exercises"><i class="fas fa-newspaper"></i> <span>Exercises library</span></a></li>
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
            <li><a href="/elements"><i class="fas fa-stairs"></i> <span>Skills</span></a></li>
            <li><a href="/challenges"><i class="fas fa-person-running"></i> <span>Challenges</span></a></li>
            <li><a href="/basics/statistics"><i class="fas fa-ranking-star"></i></i> <span>Basics</span></a></li>
            <li><a href="/posts"><i class="fas fa-newspaper"></i> <span>Articles</span></a></li>
            <li><a href="/exercises"><i class="fas fa-newspaper"></i> <span>Exercises library</span></a></li>
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