import { ComponentFixture, TestBed } from '@angular/core/testing';

import { LatestHotelBookingsComponent } from './latest-hotel-bookings.component';

describe('LatestHotelBookingsComponent', () => {
  let component: LatestHotelBookingsComponent;
  let fixture: ComponentFixture<LatestHotelBookingsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ LatestHotelBookingsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(LatestHotelBookingsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
