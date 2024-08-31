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

  originalData: any[] = []; 

  constructor(private availableService: AvailableService) {}

  ngOnInit(): void {
    this.originalData = this.availables.map(available => ({ ...available }));
  }

  edit(index: number): void {
    this.availables[index].isEditable = true;
  }

  save(index: number): void {
    this.availables[index].isEditable = false;
    const updatedData = this.availables[index];
    
    this.availableService.updateAvailable(updatedData.CarRentalID, updatedData).subscribe(
      response => {
        console.log('Save successful', response);
        this.availables[index].isEditable = false;
        this.originalData[index] = { ...updatedData };
      },
      error => {
        console.error('Save failed', error);
      }
    );
  }

  cancelEdit(index: number): void {
    this.availables[index] = { ...this.originalData[index] };
    this.availables[index].isEditable = false;
  }

  delete(id: number): void {
    this.availableService.deleteAvailable(id).subscribe(
      response => {
        console.log('Delete successful', response);
        this.availables = this.availables.filter(item => item.CarRentalID !== id);
        this.originalData = this.originalData.filter(item => item.CarRentalID !== id);
      },
      error => {
        console.error('Delete failed', error);
      }
    );
  }

  addNewRow(): void {
    const newCar = {
      isEditable: true
    } as any;  
    
    this.columns.forEach(col => newCar[col] = '');
    this.availables.push(newCar);
  }
}
