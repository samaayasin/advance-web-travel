import { Component, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-rate-modal',
  templateUrl: './review-modal.component.html',
  styleUrls: ['./review-modal.component.css']
})
export class ReviewModalComponent {
  @Input() showModal: boolean = false;
  @Input() bookingId: any;
  @Output() close = new EventEmitter<{ bookingId: any, rating: number, reviewText: string }>();
  rating: number = 4;
  reviewText: string = "Good service";

  closeModal() {
    this.showModal = false;
    this.close.emit();
  }

  submitRating() {
    if (this.rating > 0) {
      this.showModal = false;
      this.close.emit({ bookingId: this.bookingId, rating: this.rating, reviewText: this.reviewText });
    } else {
      alert("Please select a rating before submitting.");
    }
  }

  setRating(star: number) {
    this.rating = star;
  }
}
