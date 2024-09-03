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
import { BookingHotelComponent } from './booking-hotel-view/booking-hotel-view.component';
import { SearchCarComponent } from './search-car/search-car.component';
import { SearchFlightComponent } from './search-flight/search-flight.component';
import { SearchHotelComponent } from './search-hotel/search-hotel.component';
import { SignInComponent } from './sign-in/sign-in.component';
import { SignUpComponent  } from './sign-up/sign-up.component';
import { ProfileComponent } from './profile/profile.component';
import { AdminCompComponent } from './admin-comp/admin-comp.component';

const routes: Routes = [
  { path: 'dashboard', component: DashboardComponent },
  { path: 'flights', component: FlightServicesComponent },
  { path: 'cars', component: CarServicesComponent },
  { path: 'hotels', component: HotelServicesComponent },
  { path: 'Summary', component: SummaryComponent },
  { path: 'users', component: UserMangementComponent },
  { path: 'bookingflight', component: BookingFlightViewComponent },
  { path: 'bookingcar', component: BookingCarViewComponent },
  { path: 'bookinghotel', component: BookingHotelComponent },
  {path:'car', component:SearchCarComponent},
  {path:'hotel', component:SearchFlightComponent},
  {path:'flight', component:SearchHotelComponent},
  {path:'home', component:SearchCarComponent},
  {path:'sign-in', component:SignInComponent},
  {path:'sign-up', component:SignUpComponent},
  {path:'profile', component:ProfileComponent},
  {path:'admin', component:AdminCompComponent},

  { path: '', redirectTo: '/dashboard', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
