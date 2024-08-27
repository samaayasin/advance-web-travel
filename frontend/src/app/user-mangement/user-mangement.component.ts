import { Component } from '@angular/core';

@Component({
  selector: 'app-user-mangement',
  templateUrl: './user-mangement.component.html',
  styleUrls: ['./user-mangement.component.css']
})
export class UserMangementComponent {
  users = [
    { name: 'John Doe', email: 'john@example.com', phoneNumber: '123-456-7890', profilePicture: '', role: 'User', isEditable: false },
    { name: 'Admin User', email: 'admin@example.com', phoneNumber: '098-765-4321', profilePicture: '', role: 'Admin', isEditable: false }
  ];

  addUser() {
    const newUser = {
      name: '',
      email: '',
      phoneNumber: '',
      profilePicture: '',
      role: 'User', // Default role for new users
      isEditable: true // Editable since it's a new entry
    };
    this.users.push(newUser);
  }

  editUser(index: number) {
    this.users[index].isEditable = true;
  }

  saveUser(index: number) {
    this.users[index].isEditable = false;
  }

  deleteUser(index: number) {
    this.users.splice(index, 1);
  }
}
