import { TestBed } from '@angular/core/testing';

import { CarSearchService } from './car-search.service';

describe('CarSearchService', () => {
  let service: CarSearchService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CarSearchService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
