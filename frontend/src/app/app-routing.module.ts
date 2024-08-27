import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DashboardComponent } from './dashboard/dashboard.component';
import { FlightServicesComponent } from './flight-services/flight-services.component';
import { CarServicesComponent } from './car-services/car-services.component';
import { SummaryComponent } from './summary/summary.component';
import { HotelServicesComponent } from './hotel-services/hotel-services.component';
import { UserMangementComponent } from './user-mangement/user-mangement.component';
import { BookingCarViewComponent } from './booking-car-view/booking-car-view.component';
import { BookingFlightViewComponent } from './booking-flight-view/booking-flight-view.component';
import { BookingHotelViewComponent } from './booking-hotel-view/booking-hotel-view.component';

const routes: Routes = [
  { path: 'dashboard', component: DashboardComponent },
  { path: 'flights', component: FlightServicesComponent },
  { path: 'cars', component: CarServicesComponent },
  { path: 'hotels', component: HotelServicesComponent },
  { path: 'Summary', component: SummaryComponent },
  { path: 'users', component: UserMangementComponent },
  { path: 'bookingflight', component: BookingFlightViewComponent },
  { path: 'bookingcar', component: BookingCarViewComponent },
  { path: 'bookinghotel', component: BookingHotelViewComponent },

  { path: '', redirectTo: '/dashboard', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
