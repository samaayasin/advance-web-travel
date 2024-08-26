import { Component } from '@angular/core';

@Component({
  selector: 'app-tables',
  templateUrl: './tables.component.html',
  styleUrls: ['./tables.component.css']
})
export class TablesComponent {
  services = [
    { name: 'Flight', details: 'Details' },
    { name: 'Car', details: 'Details' },
    { name: 'Hotel', details: 'Details' }
  ];
  total = [
    { name: 'Flight', details: 'Details' },
    { name: 'Car', details: 'Details' },
    { name: 'Hotel', details: 'Details' },
    { name: 'Total', details: 'Details' }

  ];

  bookings = [
    {
      imageUrl: '../assets/H.jpeg',
      hotelName: 'Hotel1',
      dateRange: 'Date Range',
      customerName: 'Customer Name',
      daysAgo: 'X days ago'
    },
    {
      imageUrl: '../assets/H2.jpeg',
      hotelName: 'Hotel2',
      dateRange: 'Another Date Range',
      customerName: 'Another Customer',
      daysAgo: 'Y days ago'
    }
  ];

}
