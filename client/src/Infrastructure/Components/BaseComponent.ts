import { Subscribable } from '../Services/Subscribable';

export abstract class BaseComponent extends Subscribable {
    constructor() {
        super();
    }
}
