import { Component, Input, OnInit } from '@angular/core';
import { AvailableService } from '../available.service';

@Component({
  selector: 'app-manage-all-services',
  templateUrl: './manage-all-services.component.html',
  styleUrls: ['./manage-all-services.component.css']
})
export class ManageAllServicesComponent implements OnInit {
  @Input() tableTitle: string = '';
  @Input() columns: string[] = [];
  @Input() availables: any[] = [];
  @Input() itemType: string = ''; // Add this to differentiate between car, flight, and hotel

  originalData: any[] = [];

  constructor(private availableService: AvailableService) {}

  ngOnInit(): void {
    this.originalData = this.availables.map(available => ({ ...available }));
  }

  edit(index: number): void {
    this.availables[index].isEditable = true;
  }

  save(index: number): void {
    const updatedData = this.availables[index];
    const idField = this.getIdField();

    // Ensure that all required fields are present
    if (!this.validateItem(updatedData)) {
        console.error('Save failed: missing required fields');
        return;
    }

    if (!updatedData[idField]) {
        // Add the new item
        this.availableService.addItem(this.itemType, updatedData).subscribe(
            response => {
                console.log('Item added successfully', response);
                this.availables[index] = { ...response, isEditable: false };
                this.originalData.push({ ...response });
            },
            error => {
                console.error('Add failed', error);
            }
        );
    } else {
        // Update the existing item
        this.availableService.updateItem(this.itemType, updatedData[idField], updatedData).subscribe(
            response => {
                console.log(`${this.itemType} save successful`, response);
                this.availables[index].isEditable = false;
                this.originalData[index] = { ...updatedData };
            },
            error => {
                console.error(`${this.itemType} save failed`, error);
            }
        );
    }
}

private validateItem(item: any): boolean {
  const missingFields: string[] = [];

  switch (this.itemType) {
      case 'car':
          if (!item.CarModel) missingFields.push('CarModel');
          if (!item.Year) missingFields.push('Year');
          if (item.PricePerDay === undefined) missingFields.push('PricePerDay');
          break;
      case 'flight':
          if (!item.AirlineName) missingFields.push('AirlineName');
          if (!item.DepartureAirport) missingFields.push('DepartureAirport');
          if (!item.ArrivalAirport) missingFields.push('ArrivalAirport');
          if (!item.DepartureTime) missingFields.push('DepartureTime');
          if (!item.ArrivalTime) missingFields.push('ArrivalTime');
          if (item.Price === undefined) missingFields.push('Price');
          break;
      case 'hotel':
          if (!item.HotelName) missingFields.push('HotelName');
          if (item.PricePerNight === undefined) missingFields.push('PricePerNight');
          if (!item.StartDate) missingFields.push('StartDate');
          if (!item.EndDate) missingFields.push('EndDate');
          break;
      default:
          return false;
  }

  if (missingFields.length > 0) {
      console.error('Save failed: missing required fields', missingFields);
      alert('missing required fields');
      return false;
  }

  return true;
}


  cancelEdit(index: number): void {
    if (!this.availables[index][this.getIdField()]) {
      this.availables.splice(index, 1);
    } else {
      this.availables[index] = { ...this.originalData[index] };
      this.availables[index].isEditable = false;
    }
  }

  delete(id: number): void {
    this.availableService.deleteItem(this.itemType, id).subscribe(
      response => {
        console.log(`${this.itemType} delete successful`, response);
        this.availables = this.availables.filter(item => item[this.getIdField()] !== id);
        this.originalData = this.originalData.filter(item => item[this.getIdField()] !== id);
      },
      error => {
        console.error(`${this.itemType} delete failed`, error);
      }
    );
  }

  addNewRow(): void {
    const newItem: { [key: string]: any } = {
        isEditable: true,
        UserID: 1, 
        Availability: true, 
        image_url: '' 
    };

    if (this.itemType === 'car') {
        Object.assign(newItem, {
            CarModel: '',
            Year: new Date().getFullYear(),
            Color: '',
            PricePerDay: 0.00
        });
    } else if (this.itemType === 'flight') {
        Object.assign(newItem, {
            AirlineName: '',
            DepartureAirport: '',
            ArrivalAirport: '',
            DepartureTime: '', 
            ArrivalTime:'',
            Price: 0.00,
            Availability:1,
            image_url:''
        });
    } else if (this.itemType === 'hotel') {
        Object.assign(newItem, {
            HotelName: '',
            rating: 1,
            PricePerNight: 0.00,
            Availability:1,
            StartDate: '', 
            EndDate: '', 
            city: '',
            county: '',
            description:'',
            image_url:'',
            number_of_guests: 1
        });
    }

    this.availables.push(newItem);
}


  
 
  private getIdField(): string {
    switch (this.itemType) {
      case 'car': return 'CarRentalID';
      case 'flight': return 'FlightID';
      case 'hotel': return 'HotelID';
      default: return '';
    }
  }
  
}  
