# coding=utf-8
require "gruff"
require "yaml"

DATA = YAML.load_file("source.yml")

# Used for access lang properties from yaml
class Lang
  def self.t(key)
    @lang ||= DATA["lang"]
    @lang[key]
  end
end

# Used for chart generation
class Generator
  def initialize(visits, week)
    @labels = Hash[Lang.t("labels").each_with_index.map { |label, idx| [label, idx] }]
    @visits = visits
    @week = week
  end
  
  def generate!
    g = Gruff::Line.new(800)
    g.title = Lang.t("title").gsub("@1", @week.to_s)
    g.theme = {
      colors: ["red", "blue"],
      marker_color: "grey",
      font_color: "black",
      background_colors: "white"
    }
    
    g.labels = @labels
    g.data(Lang.t("were"), @visits.map { |x| x.split("/").first.to_f })
    g.data(Lang.t("was"), @visits.map { |x| x.split("/").last.to_f })
    g.write("output/week-#{@week}.png")
  end
end

# Generate charts for all visits
DATA["visits"].each_with_index { |visits, idx|
  generator = Generator.new(visits, idx+1)
  generator.generate!
}

# Generate index.html
html = %Q{
<!DOCTYPE html>
<html>
<head>
  <title>Visits</title>
</head>
<body>
  #{DATA["visits"].each_with_index.map { |_, idx| "<img src='output/week-#{idx+1}.png' />" }.join("\n")}
</body>
</html>
}

File.open("index.html", "w") { |f| f.write html }