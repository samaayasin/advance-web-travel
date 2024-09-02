import { Component, OnInit } from '@angular/core';
import { ProfileService } from '../services/profile.service';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  user: any;

  constructor(private profileService: ProfileService, private router: Router, private authService:AuthService){}
  
  ngOnInit(): void {
    this.profileService.getUser()?.subscribe({
      next: (response) => {
        this.user = response
      },
      error: (error) => {
        alert("Your session is expired relogin again")
        this.router.navigate(['/sign-in'])
        this.authService.logout();
        console.log(error);
        
      }
    });
    
  }

}
