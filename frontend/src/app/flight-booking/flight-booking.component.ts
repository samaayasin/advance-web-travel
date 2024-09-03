import { Component } from '@angular/core';
import { FlightBookingService } from '../flight-booking.service';
import { FlightService } from '../services/flight.service';
import { AuthService } from '../services/auth.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-flight-booking',
  templateUrl: './flight-booking.component.html',
  styleUrls: ['./flight-booking.component.css']
})
export class FlightBookingComponent {
  FlightId: string | null = null;
  startDate: string = '';
  endDate: string = '';
  AirlineName: string = '';
  DepartureAirport: string = '';
  ArrivalAirport: string = '';
  DepartureTime: string = '';
  ArrivalTime: string = '';
  Price: number = 0;
  totalPrice: number = 0;
  Numberofpassengers: number = 1;


  constructor(
    private flightBookingService: FlightBookingService,
    private flightService: FlightService,
    private authService: AuthService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.FlightId = params['flightId'];
      if (this.FlightId) {
        this.fetchFlightDetails(this.FlightId);
      }
    });
  }

  fetchFlightDetails(FlightId: string): void {
    const filters = { FlightId: FlightId };
    this.flightService.searchFlights(filters).subscribe({
      next: (flight) => {
        if (flight.length > 0) {
          const flights = flight[0]; 
          this.AirlineName = flights.AirlineName;
          this.DepartureAirport = flights.DepartureAirport;
          this.ArrivalAirport = flights.ArrivalAirport;
          this.DepartureTime = flights.DepartureTime;
          this.ArrivalTime = flights.ArrivalTime;
          this.Price = flights.Price;
        }
      },
      error: (error) => {
        console.error('Error fetching flight details:', error);
      }
    });
  }

  calculateTotalPrice(): void {
    if (this.Numberofpassengers) {
      this.totalPrice = this.Price * this.Numberofpassengers;
    } else {
      this.totalPrice = 0;
    }
  }

  onBookFlight(): void {
    if (this.FlightId) {
      const flightBookingDetails = {
        FlightID: this.FlightId,
        Numberofpassengers: this.Numberofpassengers,
      };

      this.flightBookingService.bookFlight(flightBookingDetails).subscribe({
        next: (response) => {
          alert('Flight booked successfully');
          this.router.navigate(['/profile']);
        },
        error: (error) => {
          console.error('Error booking Flight:', error);
          alert('Failed to book Flight');
        }
      });
    } else {
      alert('Flight ID is missing.');
    }
  }

}
