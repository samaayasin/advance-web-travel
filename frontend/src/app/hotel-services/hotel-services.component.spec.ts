import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HotelServicesComponent } from './hotel-services.component';

describe('HotelServicesComponent', () => {
  let component: HotelServicesComponent;
  let fixture: ComponentFixture<HotelServicesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ HotelServicesComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(HotelServicesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
