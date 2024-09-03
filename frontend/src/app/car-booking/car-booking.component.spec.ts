import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CarBookingComponent } from './car-booking.component';

describe('CarBookingComponent', () => {
  let component: CarBookingComponent;
  let fixture: ComponentFixture<CarBookingComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CarBookingComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CarBookingComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
