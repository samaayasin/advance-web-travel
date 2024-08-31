import { Component,Input,Output,EventEmitter,OnInit } from '@angular/core';
import { AvailableService } from '../available.service';
@Component({
  selector: 'app-car-services',
  templateUrl: './car-services.component.html',
  styleUrls: ['./car-services.component.css']
})
export class CarServicesComponent implements OnInit{
  car: any[] = []; 

  constructor(private AvailableService: AvailableService) {}

  ngOnInit() {
    this.AvailableService.getCars().subscribe(
      data => this.car = data,
      error => console.error('Error fetching car data', error)
    );
  }
}
