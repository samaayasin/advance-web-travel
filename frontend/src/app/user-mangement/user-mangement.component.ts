import { Component,OnInit } from '@angular/core';
import { ChangeDetectorRef } from '@angular/core';

import { UserService } from '../user.service';
@Component({
  selector: 'app-user-mangement',
  templateUrl: './user-mangement.component.html',
  styleUrls: ['./user-mangement.component.css']
})
export class UserMangementComponent implements OnInit{
  users: any[] = [];
  isLoading = false;
  errorMessage: string | null = null;

  constructor(private userService: UserService, private cdr: ChangeDetectorRef) {}

  ngOnInit(): void {
    this.loadUsers();
  }

  loadUsers(): void {
    this.isLoading = true;
    this.errorMessage = null;

    this.userService.getUsers().subscribe({
      next: (data) => {
        this.users = data.map(user => ({
          ...user,
          isEditable: false 
        }));
        console.log('Users loaded:', this.users);
        this.isLoading = false;
      },
      error: (err) => {
        this.errorMessage = 'Error fetching users';
        console.error('Error fetching users:', err);
        this.isLoading = false;
      }
    });
  }

  addUser(): void {
    if (this.users.some(user => user.isEditable)) {
      alert('Please save the current user before adding a new one.');
      return;
    }
  
    const newUser = {
      UserID: null,
      Name: '',
      Email: '',
      Password: '', 
      PhoneNumber: '',
      ProfilePicture: null,
      Role: 'User',
      isEditable: true
    };
    this.users.push(newUser);
    console.log('New user added:', newUser);
  }
  
  editUser(index: number): void {
    this.users[index].isEditable = true;
    console.log(`Editing user at index ${index}:`, this.users[index]);
  }

  saveUser(index: number): void {
    const user = this.users[index];

    if (!user.Name || !user.Email || !user.PhoneNumber || !user.Password || !user.Role) {
      alert('Please fill in all required fields.');
      return;
    }

    console.log('User payload before sending:', {
      Name: user.Name,
      Email: user.Email,
      Password: user.Password,
      PhoneNumber: user.PhoneNumber,
      ProfilePicture: user.ProfilePicture || null,
      Role: user.Role
    });

    const userPayload = {
      Name: user.Name,
      Email: user.Email,
      Password: user.Password,
      PhoneNumber: user.PhoneNumber,
      ProfilePicture: user.ProfilePicture || null,
      Role: user.Role
    };

    if (user.UserID) {
      this.userService.updateUser(user.UserID, userPayload).subscribe({
        next: (updatedUser) => {
          this.users[index] = { ...updatedUser, isEditable: false };
          console.log('User updated successfully:', updatedUser);
          this.cdr.detectChanges();
        },
        error: (err) => {
          console.error('Failed to update user:', err);
          this.errorMessage = 'Failed to update user. ' + (err.error?.message || 'Please try again.');
        }
      });
    } else {
      this.userService.addUser(userPayload).subscribe({
        next: (newUser) => {
          this.users[index] = { ...newUser, isEditable: false };
          console.log('New user added successfully:', newUser);
        },
        error: (err) => {
          console.error('Failed to add user:', err);
          this.errorMessage = 'Failed to add user. ' + (err.error?.message || 'Please try again.');
        }
      });
    }
  }
    
  

  confirmDeleteUser(index: number): void {
    const confirmed = confirm('Are you sure you want to delete this user?');
    if (confirmed) {
      this.deleteUser(index);
    }
  }

  deleteUser(index: number): void {
    const user = this.users[index];

    if (user.UserID) {
      this.userService.deleteUser(user.UserID).subscribe({
        next: () => {
          console.log('User deleted:', user);
          this.users.splice(index, 1); 
        },
        error: () => {
          this.errorMessage = 'Failed to delete user';
        }
      });
    } else {
      console.log('Unsaved user removed:', user);
      this.users.splice(index, 1); 
    }
  }
}
