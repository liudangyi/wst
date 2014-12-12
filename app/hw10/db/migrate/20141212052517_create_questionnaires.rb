class CreateQuestionnaires < ActiveRecord::Migration
  def change
    create_table :questionnaires do |t|
      t.string :name
      t.string :age
      t.string :gender
      t.string :email

      t.timestamps
    end
  end
end
