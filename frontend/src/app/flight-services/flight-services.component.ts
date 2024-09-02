import { Component,OnInit } from '@angular/core';
import { AvailableService } from '../available.service'; 

@Component({
  selector: 'app-flight-services',
  templateUrl: './flight-services.component.html',
  styleUrls: ['./flight-services.component.css']
})
export class FlightServicesComponent implements OnInit {
  flight: any[] = []; 

  constructor(private AvailableService: AvailableService) {}

  ngOnInit() {
    this.AvailableService.getItems('flight').subscribe(
      data => this.flight = data,
      error => console.error('Error fetching car data', error)
    );
  }
}
