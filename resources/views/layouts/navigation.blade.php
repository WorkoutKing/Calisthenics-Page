<div class="sidebar collapsed">
  <div class="sidebar-header">
    <h3>Menu</h3>
    <button class="sidebar-toggle">
      <i class="fas fa-bars"></i>
    </button>
  </div>
  <ul class="sidebar-menu">
    <li><a href="/elements"><i class="fas fa-envelope"></i> <span>Elements</span></a></li>
    <li><a href="/challenges"><i class="fas fa-inbox"></i> <span>challenges</span></a></li>
    <li><a href="/basics/statistics"><i class="fas fa-file"></i> <span>Basics</span></a></li>
    <li><a href="/posts"><i class="fas fa-star"></i> <span>News & Updates</span></a></li>
    <li><a href="/register"><i class="fas fa-paper-plane"></i> <span>Register</span></a></li>
    <li><a href="/login"><i class="fas fa-paper-plane"></i> <span>Login</span></a></li>
    {{--  <li><a href="#"><i class="fas fa-trash"></i> <span>Trash</span></a></li>
    <li><a href="#"><i class="fas fa-spam"></i> <span>Spam</span></a></li>  --}}
  </ul>
</div>

<style>
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
    border: 1px solid;
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

.sidebar-menu li a:hover {
  background-color: #444;
}

.sidebar.collapsed .sidebar-header h3 {
  display: none;
}

.sidebar.collapsed .sidebar-menu li a span {
  display: none;
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
