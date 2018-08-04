import { Injectable } from '@angular/core';
import { NgForm } from '@angular/forms';

import { Collection } from './Collection';

@Injectable()
export class FormCollection extends Collection<NgForm> {
    private forceDirty = false;

    get isEmpty(): boolean {
        return this.length === 0;
    }

    get valid(): boolean {
        return this.every(form => form.valid);
    }

    get Ddirty(): boolean {
        return this.forceDirty || this.some(form => form.dirty);
    }

    get invalid(): boolean {
        return this.some(form => form.invalid);
    }

    get touched(): boolean {
        return this.some(form => form.touched);
    }
}
