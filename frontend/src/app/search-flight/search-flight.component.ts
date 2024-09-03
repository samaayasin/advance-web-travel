import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { FlightService } from '../services/flight.service';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-search-flight',
  templateUrl: './search-flight.component.html',
  styleUrls: ['./search-flight.component.css']
})
export class SearchFlightComponent implements OnInit {
  flightSearchForm: FormGroup;
  flights: any[] = [];

  constructor(private router: Router,private authService: AuthService,private fb: FormBuilder, private flightService: FlightService) {
    // Initialize the form with the fields and default values
    this.flightSearchForm = this.fb.group({
      AirlineName: [''],
      DepartureAirport: [''],
      ArrivalAirport: [''],
      DepartureTime: [''],
      ArrivalTime: [''],
      Price: ['']
    });
  }

  ngOnInit(): void {}

  onSearch(): void {
    // Get form values and perform search using FlightService
    const filters = this.flightSearchForm.value;
    this.flightService.searchFlights(filters).subscribe(
      (data: any) => {
        this.flights = data; // Assign search results to the flights array
      },
      (error) => {
        console.error('Error fetching flights:', error); // Handle errors appropriately
      }
    );
  }
  onBookNow(flightId: string) {
    this.authService.getIsLoggedIn().subscribe(isLoggedIn => {
      if (isLoggedIn) {
        this.router.navigate(['/flightbooking'], { queryParams: { flightId: flightId } });

      } else {
        this.router.navigate(['/sign-in']);
      }
    });
  }

}
