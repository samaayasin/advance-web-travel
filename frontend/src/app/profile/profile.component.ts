import { Component, Inject, OnInit } from '@angular/core';
import { ProfileService } from '../services/profile.service';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { FlightService } from '../services/flight.service';
import { BookService } from '../services/book.service';
import { RateService } from '../services/rate.service';
import { forkJoin, map } from 'rxjs';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  user: any;
  flights: any[] = [];
  showRateModal: boolean = false;
  selectedBookingId: any;
  bookingType: string="";

  constructor(private rateSerivce: RateService, private flightService: FlightService, private bookService: BookService,private profileService: ProfileService, private router: Router, private authService:AuthService){}
  
  ngOnInit(): void {
    const userObservable = this.profileService.getUser();
    if (userObservable) {
      userObservable.subscribe({
        next: (response) => {
          if (response) {            
            this.user = response;
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

      this.bookService.getBookingFlights().subscribe({
        next: (bookingResponse) => {
          const bookingFlights = bookingResponse.flights;
      
          const flightDetailsObservables = bookingFlights.map((bookingFlight: any) => {
            const filters = { FlightID: bookingFlight.FlightID };
            return this.flightService.searchFlights(filters).pipe(
              map((flightDetails: any) => ({
                ...bookingFlight,
                ...flightDetails[0],
              }))
            );
          });
      
          forkJoin(flightDetailsObservables).subscribe({
            next: (flightsWithDetails: any) => {
              console.log(flightsWithDetails);
              this.flights = flightsWithDetails;
            },
            error: (error) => {
              console.error("Error fetching flight details: ", error);
            }
          });
        },
        error: (error) => {
          console.error("Error fetching booking flights: ", error);
        }
      });
      

    } else {
      alert("Failed to retrieve user data. Please try again.");
      this.router.navigate(['/sign-in']);
      this.authService.logout();
    }
    
  }

  openRateModal(bookingId: any, bookingType:string ) {
    this.bookingType = bookingType;
    this.selectedBookingId = bookingId;
    this.showRateModal = true;
  }

  handleRateClose(event: { bookingId: any, rating: number, reviewText: string } | null) {
    this.showRateModal = false;
    if (event) {
      this.rate(event.bookingId, this.bookingType, event.rating, event.reviewText);
    }
  }

  rate(bookingId: any, bookingType: string, rating: number, reviewText: string): void {
    this.rateSerivce.rateBookingService(bookingType, bookingId, rating, reviewText).subscribe({
      next: (response) => {
        alert('Rating submitted successfully');
      },
      error: (error) => {
        console.error('Error submitting rating:', error);
      }
    });
  }
}
