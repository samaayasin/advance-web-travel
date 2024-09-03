import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BookingHotelViewComponent } from './booking-hotel-view.component';

describe('BookingHotelViewComponent', () => {
  let component: BookingHotelViewComponent;
  let fixture: ComponentFixture<BookingHotelViewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BookingHotelViewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(BookingHotelViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
