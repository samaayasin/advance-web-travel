import { Component } from '@angular/core';

@Component({
  selector: 'app-tables',
  templateUrl: './tables.component.html',
  styleUrls: ['./tables.component.css']
})
export class TablesComponent {
  total = [
    { name: 'Flight', details: '50%' },
    { name: 'Car', details: '10%' },
    { name: 'Hotel', details: '30%' },
    { name: 'Total', details: '90%' }

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
