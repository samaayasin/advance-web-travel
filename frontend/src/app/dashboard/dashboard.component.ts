import { Component,HostListener } from '@angular/core';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent {
  isSidebarCollapsed = false;  // Sidebar is expanded by default on larger screens

  constructor() {
    this.checkScreenSize();
  }

  // Detect screen size and collapse sidebar on small screens
  @HostListener('window:resize', ['$event'])
  onResize(event: Event) {
    this.checkScreenSize();
  }

  // Check the screen size and toggle sidebar accordingly
  checkScreenSize() {
    const screenWidth = window.innerWidth;
    if (screenWidth < 768) {
      this.isSidebarCollapsed = true;  // Collapse sidebar for small screens
    } else {
      this.isSidebarCollapsed = false;  // Keep sidebar expanded for large screens
    }
  }

  // Function to toggle sidebar on mobile
  toggleSidebar() {
    this.isSidebarCollapsed = !this.isSidebarCollapsed;
  }
}
