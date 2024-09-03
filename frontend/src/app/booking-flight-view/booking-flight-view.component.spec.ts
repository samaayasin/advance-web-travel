import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BookingFlightViewComponent } from './booking-flight-view.component';

describe('BookingFlightViewComponent', () => {
  let component: BookingFlightViewComponent;
  let fixture: ComponentFixture<BookingFlightViewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BookingFlightViewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(BookingFlightViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
