import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TotalBookingsComponent } from './total-bookings.component';

describe('TotalBookingsComponent', () => {
  let component: TotalBookingsComponent;
  let fixture: ComponentFixture<TotalBookingsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ TotalBookingsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(TotalBookingsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
