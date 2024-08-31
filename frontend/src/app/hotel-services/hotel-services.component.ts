import { Component,Input,Output,EventEmitter } from '@angular/core';

@Component({
  selector: 'app-hotel-services',
  templateUrl: './hotel-services.component.html',
  styleUrls: ['./hotel-services.component.css']
})
export class HotelServicesComponent {
    @Input() hotels: any[] = [];
    @Output() updateHotels = new EventEmitter<any[]>();
  
    // Methods for editing/deleting hotels can be added here
    editHotel(hotel: any) {
      // Perform edit operation
      this.updateHotels.emit(this.hotels);
    }
  
    deleteHotel(hotelId: number) {
      this.hotels = this.hotels.filter(hotel => hotel.id !== hotelId);
      this.updateHotels.emit(this.hotels);
    }
}
