import { Component,OnInit } from '@angular/core';
import { AvailableService } from '../available.service'; 

@Component({
  selector: 'app-flight-services',
  templateUrl: './flight-services.component.html',
  styleUrls: ['./flight-services.component.css']
})
export class FlightServicesComponent implements OnInit {
  flights: any[] = [];
  showFlightForm: boolean = false;  // Controls form visibility
  newFlight: any = {
    AirlineName: '',
    DepartureAirport: '',
    ArrivalAirport: '',
    DepartureTime: '',
    ArrivalTime: '',
    Price: 0.00,
    Availability: true
  };

  constructor(private availableService: AvailableService) {}

  ngOnInit() {
    this.loadFlights();
  }

  loadFlights() {
    this.availableService.getAllFlights().subscribe(
      (data: any[]) => {
        this.flights = data;
      },
      (error) => {
        console.error('Error loading flights:', error);
      }
    );
  }

  toggleFlightForm() {
    this.showFlightForm = !this.showFlightForm;  // Toggle form visibility
  }

  addFlight() {
    this.availableService.addFlight(this.newFlight).subscribe(
      (data) => {
        this.flights.push(data);
        this.toggleFlightForm();  // Hide the form after adding a flight
        this.resetForm();  // Reset the form fields
      },
      (error) => {
        console.error('Error adding flight:', error);
      }
    );
  }

  resetForm() {
    this.newFlight = {
      AirlineName: '',
      DepartureAirport: '',
      ArrivalAirport: '',
      DepartureTime: '',
      ArrivalTime: '',
      Price: 0.00,
      Availability: true
    };
  }

  editFlight(index: number) {
    this.flights[index].isEditable = true;
  }

  saveFlight(index: number) {
    this.flights[index].isEditable = false;
  }

  deleteFlight(index: number) {
    this.flights.splice(index, 1);
  }
}
