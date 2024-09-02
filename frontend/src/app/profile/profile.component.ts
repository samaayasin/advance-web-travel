import { Component, Inject, OnInit } from '@angular/core';
import { ProfileService } from '../services/profile.service';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { FlightService } from '../services/flight.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  user: any;
  flights: any[] = [];

  constructor(private flightService: FlightService,private profileService: ProfileService, private router: Router, private authService:AuthService){}
  ngOnInit(): void {
    const userObservable = this.profileService.getUser();
    if (userObservable) {
      userObservable.subscribe({
        next: (response) => {
          if (response) {
            console.log(response);
            
            this.user = response;
    
            this.flightService.getFlightsForUser(response.UserID).subscribe({
              next: (flightsResponse) => {
                console.log(flightsResponse);
                this.flights = flightsResponse;
              },
              error: (error) => {
                console.error("Error fetching flights: ", error);
              }
            });
          } else {
            alert("Failed to retrieve user data. Please try again.");
            this.router.navigate(['/sign-in']);
            this.authService.logout();
          }
        },
        error: (error) => {
          alert("Your session has expired. Please relogin.");
          this.router.navigate(['/sign-in']);
          this.authService.logout();
          console.error("Error fetching user data: ", error);
        }
      });
    } else {
      alert("Failed to retrieve user data. Please try again.");
      this.router.navigate(['/sign-in']);
      this.authService.logout();
    }
    
  }

}
