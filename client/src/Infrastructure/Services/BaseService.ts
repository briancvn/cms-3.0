import { Subscribable } from '../Common/Subscribable';
import { ISettings } from '../Interfaces/ISettings';
import { Authenticate } from '../Models/Authenticate';

declare var settings: ISettings;
declare var userContext: Authenticate;

export abstract class BaseService extends Subscribable {
    get settings(): ISettings { return settings; }
    get userContext(): Authenticate { return userContext; }
    set userContext(value: Authenticate) { userContext = value; }
}
