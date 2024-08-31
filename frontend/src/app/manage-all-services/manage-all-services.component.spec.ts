import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ManageAllServicesComponent } from './manage-all-services.component';

describe('ManageAllServicesComponent', () => {
  let component: ManageAllServicesComponent;
  let fixture: ComponentFixture<ManageAllServicesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ManageAllServicesComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ManageAllServicesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
