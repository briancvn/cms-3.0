import { HostBinding } from '@angular/core';
import { kebabCase } from 'lodash';

import { Subscribable } from '../Services/Subscribable';
import { CommonConstants } from '../Constants/CommonConstants';

export abstract class BaseComponent extends Subscribable {
    @HostBinding('class') get componentClass(): string {
        return kebabCase(this.constructor.name.replace(new RegExp('Component$'), CommonConstants.EMPTY));
    }
}
