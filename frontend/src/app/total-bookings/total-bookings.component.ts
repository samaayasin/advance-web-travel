import { Component } from '@angular/core';

@Component({
  selector: 'app-total-bookings',
  templateUrl: './total-bookings.component.html',
  styleUrls: ['./total-bookings.component.css']
})
export class TotalBookingsComponent {
  total = [
    { name: 'Flight', details: '50%' },
    { name: 'Car', details: '10%' },
    { name: 'Hotel', details: '30%' },
    { name: 'Total', details: '90%' }
  ];

  constructor() { }

}
