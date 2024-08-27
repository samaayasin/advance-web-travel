import { Component } from '@angular/core';

@Component({
  selector: 'app-car-services',
  templateUrl: './car-services.component.html',
  styleUrls: ['./car-services.component.css']
})
export class CarServicesComponent {
  cars = [
    { CarModel: 'Toyota Camry', Year: 2018, Color: 'Red', PricePerDay: 50.00, Availability: true, image_url: '', isEditable: false },
    // Add more cars here
];

addCar() {
    const newCar = {
        CarModel: '',
        Year: 2021,
        Color: '',
        PricePerDay: 0,
        Availability: true,
        image_url: '',
        isEditable: true
    };
    this.cars.push(newCar);
}

editCar(index: number) {
    this.cars[index].isEditable = true;
}

saveCar(index: number) {
    this.cars[index].isEditable = false;
}

deleteCar(index: number) {
    this.cars.splice(index, 1);
}

}
