import { Component } from '@angular/core';
import { Router, NavigationEnd } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Frontend';
  showNavbar = true;

  constructor(private router: Router) {}

  ngOnInit() {
    this.router.events.subscribe(event => {
      if (event instanceof NavigationEnd) {
        const hiddenRoutes = ['/admin', '/Summary', '/flights', '/cars','/hotels','/bookingflight','/bookinghotel','/bookingcar','/users'];
        this.showNavbar = !hiddenRoutes.some(route => event.url.includes(route));
      }
    });
  }
}
