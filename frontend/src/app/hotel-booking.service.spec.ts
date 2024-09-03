import { TestBed } from '@angular/core/testing';

import { HotelBookingService } from './hotel-booking.service';

describe('HotelBookingService', () => {
  let service: HotelBookingService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(HotelBookingService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
