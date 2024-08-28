import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { FlightService } from '../services/flight.service';

@Component({
  selector: 'app-search-flight',
  templateUrl: './search-flight.component.html',
  styleUrls: ['./search-flight.component.css']
})
export class SearchFlightComponent implements OnInit {
  flightSearchForm: FormGroup;
  flights: any[] = [];

  constructor(private fb: FormBuilder, private flightService: FlightService) {
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
}
