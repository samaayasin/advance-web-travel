import { Component,OnInit,Input,Output,EventEmitter } from '@angular/core';
import { AvailableService } from '../available.service'; 

@Component({
  selector: 'app-flight-services',
  templateUrl: './flight-services.component.html',
  styleUrls: ['./flight-services.component.css']
})
export class FlightServicesComponent {
  @Input() flights: any[] = [];
  @Output() updateFlights = new EventEmitter<any[]>();

  // Methods for editing/deleting flights can be added here
  editFlight(flight: any) {
    // Perform edit operation
    this.updateFlights.emit(this.flights);
  }

  deleteFlight(flightId: number) {
    this.flights = this.flights.filter(flight => flight.id !== flightId);
    this.updateFlights.emit(this.flights);
  }
}
