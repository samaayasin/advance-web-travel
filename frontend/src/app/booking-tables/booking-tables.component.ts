import { Component,Input } from '@angular/core';

@Component({
  selector: 'app-booking-tables',
  templateUrl: './booking-tables.component.html',
  styleUrls: ['./booking-tables.component.css']
})
export class BookingTablesComponent {
  @Input() bookings: any[] = [];
  @Input() columns: string[] = [];
  @Input() tableTitle: string = '';
}
