import { Injectable } from '@angular/core';
import { UserService } from './user.service';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor() { }

  isAuth = false;

  signIn() {
    return new Promise(
      () => {
        this.isAuth = true
      }
    );
  }

}
