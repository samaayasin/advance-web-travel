import { Component } from '@angular/core';

@Component({
  selector: 'app-hotel-services',
  templateUrl: './hotel-services.component.html',
  styleUrls: ['./hotel-services.component.css']
})
export class HotelServicesComponent {
  hotels = [
    { HotelName: 'Marriott', rating: 5, PricePerNight: 200.00, Availability: true, StartDate: '2023-01-01', EndDate: '2023-12-31', city: 'New York', county: 'USA', isEditable: false },
    // Add more hotels here
];

addHotel() {
    const newHotel = {
        HotelName: '',
        rating: 1,
        PricePerNight: 0,
        Availability: true,
        StartDate: '',
        EndDate: '',
        city: '',
        county: '',
        isEditable: true
    };
    this.hotels.push(newHotel);
}

editHotel(index: number) {
    this.hotels[index].isEditable = true;
}

saveHotel(index: number) {
    this.hotels[index].isEditable = false;
}

deleteHotel(index: number) {
    this.hotels.splice(index, 1);
}

}
