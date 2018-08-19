import { Injectable, Injector, SkipSelf } from '@angular/core';

@Injectable()
export class ParentInjectorResolver {
    constructor(@SkipSelf() public injector: Injector)  {}
}
