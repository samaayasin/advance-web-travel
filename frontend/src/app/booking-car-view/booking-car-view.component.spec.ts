import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BookingCarViewComponent } from './booking-car-view.component';

describe('BookingCarViewComponent', () => {
  let component: BookingCarViewComponent;
  let fixture: ComponentFixture<BookingCarViewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BookingCarViewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(BookingCarViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
