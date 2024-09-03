import { TestBed } from '@angular/core/testing';

import { AvailableService } from './available.service';

describe('AvailableService', () => {
  let service: AvailableService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AvailableService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
