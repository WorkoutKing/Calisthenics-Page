<div class="sidebar collapsed">
    <div class="sidebar-header">
        <h3>Menu</h3>
        <button class="sidebar-toggle" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <ul class="sidebar-menu">
        @if(Auth::user())
            <li><a href="/" aria-label="Home page"><i class="fas fa-house"></i> <span>Home</span></a></li>
            <li><a href="/elements" aria-label="Elements page"><i class="fa-solid fa-bars-progress"></i> <span>Progressions</span></a></li>
            <li><a href="/challenges" aria-label="Challenges page"><i class="fa-solid fa-hand-fist"></i> <span>Challenges</span></a></li>
            <li><a href="/basics" aria-label="Basics page"><i class="fa-solid fa-trophy"></i> <span>Basics</span></a></li>
            <li><a href="/exercises" aria-label="Exercises page"><i class="fa-solid fa-book-open"></i> <span>Exercises library</span></a></li>
            <li><a href="/posts" aria-label="Posts page"><i class="fas fa-newspaper"></i> <span>Our Blog</span></a></li>
            <li><a href="/about-us" aria-label="About us page"><i class="fa-solid fa-circle-info"></i> <span>About Us</span></a></li>
            <br>
            @if (auth()->user()->role_id == 2)
                <li><a href="/admin/dashboard" aria-label="Admin dashboard"><i class="fas fa-user-tie"></i><span>Admin Dashboard</span></a></li>
            @endif
            <li><a href="/profile"><i class="fas fa-user" aria-label="Profile page"></i><span>Profile</span></a></li>
            <li class="relative">
                <a href="/profile/notifications" class="relative" aria-label="Notifications page">
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
            <li><a href="/profile/settings" aria-label="Settings"><i class="fas fa-gears"></i><span>Profile settings</span></a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="/logout" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-right-to-bracket" aria-label="Logout"></i></i> <span>Log out</span></a>
                </form>
            </li>
        @else
            <li><a href="/" aria-label="Home page"><i class="fas fa-house"></i> <span>Home</span></a></li>
            <li><a href="/elements" aria-label="Elements page"><i class="fa-solid fa-bars-progress"></i> <span>Progressions</span></a></li>
            <li><a href="/basics/statistics" aria-label="Statistics page"><i class="fa-solid fa-trophy"></i> <span>Basics</span></a></li>
            <li><a href="/exercises" aria-label="Exercises page"><i class="fa-solid fa-book-open"></i> <span>Exercises library</span></a></li>
            <li><a href="/posts" aria-label="Posts page"><i class="fas fa-newspaper"></i> <span>Our Blog</span></a></li>
            <li><a href="/about-us" aria-label="About us page"><i class="fa-solid fa-circle-info"></i> <span>About Us</span></a></li>
            <!-- Add Register and Login buttons for mobile -->
            <li class="mobile-auth-links">
                <a href="/register" aria-label="Register"><i class="fas fa-user-plus"></i> <span>Register</span></a>
            </li>
            <li class="mobile-auth-links">
                <a href="/login" aria-label="Login"><i class="fas fa-sign-in-alt"></i> <span>Login</span></a>
            </li>
        @endif
    </ul>
</div>
<style>
    @media screen and (max-width: 700px) {
        .sidebar {
            height: auto;
        }
    }
</style>