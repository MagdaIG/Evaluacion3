/*
 * API de Energy and Water
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 *
 * Swagger Codegen version: 3.0.57
 *
 * Do not edit the class manually.
 *
 */
import ApiClient from '../ApiClient';

/**
 * The CategoriaServicioIdBody1 model module.
 * @module model/CategoriaServicioIdBody1
 * @version 1.0.0
 */
export default class CategoriaServicioIdBody1 {
  /**
   * Constructs a new <code>CategoriaServicioIdBody1</code>.
   * @alias module:model/CategoriaServicioIdBody1
   * @class
   */
  constructor() {
  }

  /**
   * Constructs a <code>CategoriaServicioIdBody1</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/CategoriaServicioIdBody1} obj Optional instance to populate.
   * @return {module:model/CategoriaServicioIdBody1} The populated <code>CategoriaServicioIdBody1</code> instance.
   */
  static constructFromObject(data, obj) {
    if (data) {
      obj = obj || new CategoriaServicioIdBody1();
      if (data.hasOwnProperty('nombre'))
        obj.nombre = ApiClient.convertToType(data['nombre'], 'String');
      if (data.hasOwnProperty('imagen'))
        obj.imagen = ApiClient.convertToType(data['imagen'], 'String');
      if (data.hasOwnProperty('texto'))
        obj.texto = ApiClient.convertToType(data['texto'], 'String');
      if (data.hasOwnProperty('activo'))
        obj.activo = ApiClient.convertToType(data['activo'], 'Boolean');
    }
    return obj;
  }
}

/**
 * @member {String} nombre
 */
CategoriaServicioIdBody1.prototype.nombre = undefined;

/**
 * @member {String} imagen
 */
CategoriaServicioIdBody1.prototype.imagen = undefined;

/**
 * @member {String} texto
 */
CategoriaServicioIdBody1.prototype.texto = undefined;

/**
 * @member {Boolean} activo
 */
CategoriaServicioIdBody1.prototype.activo = undefined;

