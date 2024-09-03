import { Component,OnInit} from '@angular/core';
import { AvailableService } from '../available.service'; 

@Component({
  selector: 'app-hotel-services',
  templateUrl: './hotel-services.component.html',
  styleUrls: ['./hotel-services.component.css']
})
export class HotelServicesComponent implements OnInit {
  hotel: any[] = []; 

  constructor(private AvailableService: AvailableService) {}

  ngOnInit() {
    this.AvailableService.getItems('hotel').subscribe(
      data => this.hotel = data,
      error => console.error('Error fetching car data', error)
    );
  }
}
