import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SummaryServiceComponent } from './summary-service.component';

describe('SummaryServiceComponent', () => {
  let component: SummaryServiceComponent;
  let fixture: ComponentFixture<SummaryServiceComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SummaryServiceComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(SummaryServiceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
