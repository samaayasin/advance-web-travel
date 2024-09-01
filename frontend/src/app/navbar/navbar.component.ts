import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class NavbarComponent implements OnInit{
  isLoggedIn: boolean = false;

  constructor(private authService: AuthService){}

  ngOnInit(): void {
    this.authService.getIsLoggedIn().subscribe((status: boolean) => {
      this.isLoggedIn = status;
    });
  }

  onLogout(): void {
    this.authService.logout();
  }
}
